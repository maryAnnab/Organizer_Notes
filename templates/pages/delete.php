<div class="show">
  <?php $note = $params['note'] ?? null; ?>
  <?php if ($note) : ?>
    <ul>
      <li>Id: <?php echo $note['id'] ?></li>
      <li>Title: <?php echo $note['title'] ?></li>
      <li>
        <pre><?php echo $note['description'] ?></pre>
      </li>
      <li>Created: <?php echo $note['created'] ?></li>
    </ul>
    <form method="POST" action="/?action=delete">
      <input name="id" type="hidden" value="<?php echo $note['id'] ?>" />
      <input type="submit" value="Delete" />
    </form>
  <?php else : ?>
    <div>There is no note to display</div>
  <?php endif; ?>
  <a href="/">
    <button>Return to note list</button>
  </a>
</div>