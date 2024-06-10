<div class="messages">
    <?php if(isset($messages)): ?>
        <?php foreach($messages as $message): ?>
            <div class="message-box">
                <p><?= $message ?></p>
                <button class="m-close-btn">&times;</button>
            </div> 
        <?php endforeach; ?>
    <?php endif; ?>
</div>