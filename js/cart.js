// js/cart.js
document.addEventListener("DOMContentLoaded", () => {
  fetchCart();

  // 주문 버튼 클릭 처리
  document.getElementById("order-button").addEventListener("click", () => {
    if (confirm("Proceed to checkout?")) {
      window.location.href = "../pages/checkout.php";
    }
  });
});

function fetchCart() {
  fetch("../api/get_cart.php")
    .then(res => res.json())
    .then(data => renderCart(data));
}

function renderCart(data) {
  const container = document.getElementById("cart-container");
  container.innerHTML = ""; // 초기화

  if (data.items.length === 0) {
    container.innerHTML = "<p>Your cart is empty.</p>";
    document.getElementById("order-button").disabled = true;
    return;
  }

  let total = 0;
  data.items.forEach(item => {
    const subtotal = item.unit_price * item.quantity;
    total += subtotal;

    container.innerHTML += `
      <div class="cart-item">
        <span>${item.name}</span>
        <span>$${item.unit_price} × 
          <input type="number" min="1" value="${item.quantity}" data-id="${item.id}" class="qty-input" />
        </span>
        <span>$${subtotal.toFixed(2)}</span>
        <button class="remove-btn" data-id="${item.id}">❌</button>
      </div>
    `;
  });

  container.innerHTML += `<h3>Total: $${total.toFixed(2)}</h3>`;
  document.getElementById("order-button").disabled = false;

  setupActions();
}

function setupActions() {
  document.querySelectorAll(".qty-input").forEach(input => {
    input.addEventListener("change", (e) => {
      const id = e.target.dataset.id;
      const qty = e.target.value;
      fetch(`../api/update_cart.php?id=${id}&qty=${qty}`).then(() => fetchCart());
    });
  });

  document.querySelectorAll(".remove-btn").forEach(btn => {
    btn.addEventListener("click", (e) => {
      const id = e.target.dataset.id;
      fetch(`../api/update_cart.php?id=${id}&qty=0`).then(() => fetchCart());
    });
  });
} 