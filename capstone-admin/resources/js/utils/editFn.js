export function startEditing(e) {
  e.target.nextElementSibling.classList.remove("hidden");
  e.target.nextElementSibling.focus();
  e.target.classList.add("hidden");
}
export function stopEditing(e) {
  e.target.classList.add("hidden");
  e.target.previousElementSibling.classList.remove("hidden");
}

