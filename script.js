document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll("[data-filter]").forEach((input) => {
    const table = document.getElementById(input.dataset.filter);
    if (!table) return;
    input.addEventListener("input", () => {
      const query = input.value.toLowerCase().trim();
      table.querySelectorAll("tbody tr").forEach((row) => {
        row.hidden = !row.textContent.toLowerCase().includes(query);
      });
    });
  });
  document.querySelectorAll("form[data-confirm]").forEach((form) => {
    form.addEventListener("submit", (event) => {
      if (!window.confirm(form.dataset.confirm)) event.preventDefault();
    });
  });
});
