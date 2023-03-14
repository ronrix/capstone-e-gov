export function searchFilter(data, search) {
  const first_option = data.filter(news => {
    return news.title.toLowerCase().includes(search.value);
  });

  const second_option = data.filter(news => {
    return news.content.toLowerCase().includes(search.value);
  });

  if(first_option.length) {
    return first_option;
  }
  return second_option;
}