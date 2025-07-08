<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redeem Item with Points</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Redeem Item with Points</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty(isset($errors) && $errors)): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $err): ?>
                                <div><?= esc($err) ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= site_url('member/pointCheckout') ?>" method="post">
                        <input type="hidden" name="item_id" value="<?= esc($item['merchandiseID']) ?>">
                        <input type="hidden" id="pointsRequired" value="<?= esc($pointsRequired) ?>">
                        <div class="mb-3">
                            <label class="form-label">Shipping Option</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="shipping_option" id="pickup" value="pickup" onchange="toggleAddressFields()" <?= (empty($shippingOption) || $shippingOption === 'pickup') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="pickup">Pickup at Gym (Free)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="shipping_option" id="delivery" value="delivery" onchange="toggleAddressFields()" <?= (isset($shippingOption) && $shippingOption === 'delivery') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="delivery">Delivery ($5)</label>
                            </div>
                        </div>
                        <div id="pickupInfo" class="mb-3" style="display: <?= (empty($shippingOption) || $shippingOption === 'pickup') ? 'block' : 'none' ?>;">
                            <div class="alert alert-success">
                                <strong>Pickup at Gym</strong><br>
                                Fitness Center Address:<br>
                                123 Fitness Street<br>
                                Kuala Lumpur, 50000<br>
                                Malaysia<br>
                                <span class="text-success"><i class="fas fa-clock"></i> Available for pickup during gym hours</span>
                            </div>
                        </div>
                        <div id="addressFields" style="display: <?= (isset($shippingOption) && $shippingOption === 'delivery') ? 'block' : 'none' ?>;">
                            <div class="mb-2">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="fullName" class="form-control" value="<?= esc($address['fullName'] ?? $userName ?? '') ?>">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" value="<?= esc($address['phone'] ?? $userPhone ?? '') ?>">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" value="<?= esc($address['address'] ?? '') ?>">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" value="<?= esc($address['city'] ?? '') ?>">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">State</label>
                                <input type="text" name="state" class="form-control" value="<?= esc($address['state'] ?? '') ?>">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Postcode</label>
                                <input type="text" name="postcode" class="form-control" value="<?= esc($address['postcode'] ?? '') ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Continue</button>
                    </form>
                    <hr>
                    <h5>Redeem Summary</h5>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><?= esc($item['name']) ?></span>
                            <span><?= esc($pointsRequired) ?> pts</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Shipping</span>
                            <span id="shippingSummary">// Will be set by JS</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Total Points Required</strong>
                            <strong id="totalPointsSummary">// Will be set by JS</strong>
                        </li>
                    </ul>
                    <p>Your Points: <strong><?= esc($userPoints) ?></strong></p>
                    <?php if ($userPoints >= $pointsRequired): ?>
                        <form action="<?= site_url('member/confirmPointRedemption') ?>" method="post" class="mt-3">
                            <button type="submit" class="btn btn-warning w-100">Confirm Redemption</button>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-danger mt-3">You do not have enough points to redeem this item.</div>
                    <?php endif; ?>
                    <a href="<?= site_url('/shop') ?>" class="btn btn-secondary w-100 mt-2">Back to Shop</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/4e9c2b1c2e.js" crossorigin="anonymous"></script>
<script>
function getShippingPoints() {
    return document.querySelector('input[name="shipping_option"]:checked').value === 'delivery' ? 5 : 0;
}
function updateSummary() {
    var shipping = document.querySelector('input[name="shipping_option"]:checked').value;
    var shippingPoints = getShippingPoints();
    var pointsRequired = parseInt(document.getElementById('pointsRequired').value);
    document.getElementById('shippingSummary').innerText = shippingPoints > 0 ? shippingPoints + ' pts' : 'Free';
    document.getElementById('totalPointsSummary').innerText = (pointsRequired + shippingPoints) + ' pts';
}
function toggleAddressFields() {
    var shipping = document.querySelector('input[name="shipping_option"]:checked').value;
    document.getElementById('addressFields').style.display = (shipping === 'delivery') ? 'block' : 'none';
    document.getElementById('pickupInfo').style.display = (shipping === 'pickup') ? 'block' : 'none';
    updateSummary();
}
window.onload = function() { toggleAddressFields(); };
</script>
</body>
</html> 