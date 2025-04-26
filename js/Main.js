document.addEventListener("DOMContentLoaded", function () {
  const toggles = document.querySelectorAll(".category-toggle");
  toggles.forEach(btn => {
    btn.addEventListener("click", () => {
      const sublist = btn.nextElementSibling;
      sublist.style.display = sublist.style.display === "block" ? "none" : "block";
    });
  });
}); 