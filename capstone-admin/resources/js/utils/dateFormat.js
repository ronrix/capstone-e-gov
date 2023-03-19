export function dateFormat(date) {
  const formattedDate = new Date(date)
  .toLocaleDateString("en-PH", 
    { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
  );

  return formattedDate;
}