import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useNewsStore = defineStore('counter', () => {
  const news = ref(null)

  function getNews() {
    return news.value;
  }

  function setNews(data) {
    news.value = data;
  }

  function getOneNews(title) {
    const temp = news.value.find(n => n.title.toLowerCase() == title);
    return temp;
  }

  return { news, setNews, getNews, getOneNews }
})