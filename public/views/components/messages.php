<div class="messages">
    <?php if(isset($messages)): ?>
        <?php foreach($messages as $message): ?>
            <div class="message-box <?= "message-{$message->getSeverity()}"?>">
                <p><?= $message->getText(); ?></p>
                <button class="m-close-btn">&times;</button>
            </div> 
        <?php endforeach; ?>
    <?php endif; ?>
</div>