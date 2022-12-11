<div class="show">
  <?php $note = $params['note'] ?? null; ?>
  <?php if ($note) : ?>
    <ul>
      <li>Id: <?php echo (int) $note['id'] ?></li>
      <li>Tytuł: <?php echo htmlentities($note['title']) ?></li>
      <li>
        <pre><?php echo htmlentities($note['description']) ?></pre>
      </li>
      <li>Zapisano: <?php echo htmlentities($note['created']) ?></li>
    </ul>
  <?php else : ?>
    <div>There is no note to display</div>
  <?php endif; ?>
  <a href="/">
    <button>Return to note list</button>
  </a>
</div>