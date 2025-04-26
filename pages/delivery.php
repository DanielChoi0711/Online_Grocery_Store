<?php
session_start();
include('../header.php');
?>

<style>
  .delivery-container {
    max-width: 600px;
    margin: 0 auto;
    text-align: left;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 12px;
    background-color: #f9f9f9;
  }
  .delivery-container h2 {
    text-align: center;
    margin-bottom: 20px;
  }
  .form-group {
    margin-bottom: 15px;
  }
  label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }
  input[type="text"],
  input[type="email"],
  input[type="tel"],
  select {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border-radius: 8px;
    border: 1px solid #ccc;
  }
  .submit-btn {
    width: 100%;
    padding: 14px;
    font-size: 18px;
    background-color: #28a745;
    border: none;
    border-radius: 8px;
    color: white;
    font-weight: bold;
    cursor: pointer;
  }
</style>

<div class="delivery-container">
  <h2>Delivery Details</h2>
  <p>Please enter your delivery details below. All fields are required. <br>
     We will use this information to deliver your order and send your confirmation via email.</p>

  <form action="../api/place_order.php" method="POST" onsubmit="return validateForm();">
    <div class="form-group">
      <label for="name">Recipient’s Name</label>
      <input type="text" id="name" name="name" required>
    </div>

    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" required>
    </div>

    <div class="form-group">
      <label for="mobile">Mobile Number</label>
      <input type="tel" id="mobile" name="mobile" required>
    </div>

    <div class="form-group">
      <label for="street">Street</label>
      <input type="text" id="street" name="street" required>
    </div>

    <div class="form-group">
      <label for="city">City/Suburb</label>
      <input type="text" id="city" name="city" required>
    </div>

    <div class="form-group">
      <label for="state">State/Territory</label>
      <select id="state" name="state" required>
        <option value="">Select</option>
        <option value="NSW">NSW</option>
        <option value="VIC">VIC</option>
        <option value="QLD">QLD</option>
        <option value="WA">WA</option>
        <option value="SA">SA</option>
        <option value="TAS">TAS</option>
        <option value="ACT">ACT</option>
        <option value="NT">NT</option>
        <option value="Others">Others</option>
      </select>
    </div>

    <button type="submit" class="submit-btn">Submit Order</button>
  </form>
</div>

<script>
  function validateForm() {
    const email = document.getElementById('email').value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      alert('Please enter a valid email address.');
      return false;
    }
    return true;
  }
</script>

<?php include('../footer.php'); ?>