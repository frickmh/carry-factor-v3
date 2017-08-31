import scrapy
import time

class QuotesSpider(scrapy.Spider):
    name = "quotes"

   

    def start_requests(self):
        urls = [
            'http://quotes.toscrape.com/page/1/',
            #'http://quotes.toscrape.com/page/2/',
        ]
        for url in urls:
            yield scrapy.Request(url=url, callback=self.parse)

    def parse(self, response):

        for i in range(3):
          try:
            time.sleep(1)
            print("Sleeping!")
          except:
            print("Except")
            break

        page = response.url.split("/")[-2]
        filename = 'quotes-%s.html' % page
        #with open(filename, 'wb') as f:
        #    f.write(response.body)
        print(response.body)


