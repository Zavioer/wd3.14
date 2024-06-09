<div class="avatar">
    <?php if(isset($user)): ?>
        <p><?= "{$user->getFirstName()} {$user->getLastName()}" ?></p>
    <?php else: ?>
        <p>Anonymous</p>
    <?php endif; ?>
    <i class="fa-solid fa-circle-user"></i>
</div>