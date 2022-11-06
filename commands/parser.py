import pandas as pd
import os 
from tqdm.auto import tqdm,trange
import json
import natasha
import sys
import fnmatch
import os 

s = sys.argv[1]
df = pd.read_excel(s,header = None)


from natasha import (
    Segmenter,
    MorphVocab,
    
    NewsEmbedding,
    NewsMorphTagger,
    NewsSyntaxParser,
    NewsNERTagger,
    
    PER,
    NamesExtractor,
    DatesExtractor,
    MoneyExtractor,
    AddrExtractor,
)

segmenter = Segmenter()
morph_vocab = MorphVocab()

addr_extractor = AddrExtractor(morph_vocab)

addresses = []
for i in trange(df.shape[0]): #iterate over rows
    for j in range(df.shape[1]): #iterate over columns
        value = str(df.at[i, j]) #get cell value
        if value:
            r = (addr_extractor.find(value))
        if r and 'д.' in value:
            addresses.append(value[r.start:r.stop])
            
addresses = list(set(addresses))

prices = {}
for i in trange(df.shape[0]): #iterate over rows
    for j in range(df.shape[1]): #iterate over columns
        value = str(df.at[i, j]) #get cell value
        if "итого по" in value.lower() and j<df.shape[1]-2:
            prices[value] = str(' '.join([str(x) for x in list(df.loc[i,1:].dropna(inplace = False))])) + ' руб.'


keywords_df = pd.read_excel('Ключевые фразы по СПГЗ.xlsx')
keywords = (',*'.join(list(keywords_df['Ключевые слова'].dropna()))).lower().replace('*','*').split(',')
values = []
for i in trange(df.shape[0]): #iterate over rows
    for j in range(df.shape[1]): #iterate over columns
        value = str(df.at[i, j]) #get cell value
        values.append(value.lower())
tasks = []
for keyword in keywords:
    tasks.extend(fnmatch.filter(values, keyword))
tasks = list(set(tasks))    
            

  
# returns JSON object as 
# a dictionary

data = {}
data['address'] = addresses
data['price'] = prices
data['tasks'] = tasks
r = json.dumps(data,ensure_ascii=False).encode('utf-8')
json.dump(r.decode(), sys.stdout,ensure_ascii=False)
