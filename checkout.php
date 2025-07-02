<html>
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Payment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Payment form goes here -->
                <!-- Example: -->
                <form id="payment-form">
                    <label for="payment-method">Select Payment Method:</label>
                    <select id="payment-method" name="payment-method">
                        <option value="mpesa">Lipa na M-Pesa</option>
                        <option value="bank">Bank Transfer</option>
                    </select>
                    <!-- Additional fields for payment details -->
                    <div id="mpesa-details" style="display:none;">
                        <label for="mpesa-number">M-Pesa Number:</label>
                        <input type="text" id="mpesa-number" name="mpesa-number">
                    </div>
                    <!-- Add more fields for bank transfer if needed -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="processPayment()">Process Payment</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function processPayment() {
        // Process payment here
        // You can use AJAX to send payment details to the server for processing
    }

    // Show/hide additional fields based on the selected payment method
    document.getElementById('payment-method').addEventListener('change', function() {
        var paymentMethod = this.value;
        if (paymentMethod === 'mpesa') {
            document.getElementById('mpesa-details').style.display = 'block';
        } else {
            document.getElementById('mpesa-details').style.display = 'none';
        }
    });
</script>
</html>
