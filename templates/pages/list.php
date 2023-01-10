<div class="list">
  <section>
    <div class="message">
      <?php
      if (!empty($params['error'])) {
        switch ($params['error']) {
          case 'missingNoteId':
            echo 'Invalid note ID';
            break;
          case 'noteNotFound':
            echo 'Note not found';
            break;
        }
      }
      ?>
    </div>
    <div class="message">
      <?php
      if (!empty($params['before'])) {
        switch ($params['before']) {
          case 'created':
            echo 'The note has been created';
            break;
          case 'deleted':
            echo 'The note has been deleted';
            break;
          case 'edited':
            echo 'The note has been edited';
            break;  
        }
      }
      ?>
    </div>


    <?php 
    $sort = $params['sort'] ?? [];
    $by = $sort['by'] ?? 'title';
    $order = $sort['order'] ?? 'desc';
    ?>

    <div>
      <form class="settings-form" action="/" method="GET">
        <div> 
          <div>Sort by:</div>
          <label>Title: <input name="sortby" type="radio" value="title" <?php echo $by === 'title' ?
          'checked' : '' ?> /></label>
          <label>Date: <input name="sortby" type="radio" value="created" <?php echo $by === 'created'  ? 
          'checked' : '' ?> /></label>
        </div>
        <div>
          <div>Sorting direction</div>
          <label>Ascending: <input name="sortorder" type="radio" value="asc" <?php echo $order === 'asc' ?
          'checked' : '' ?> /></label>
          <label>Descending: <input name="sortorder" type="radio" value="desc" <?php echo $order === 'desc' ?
          'checked' : '' ?> /></label>
        </div>
        <input type="submit" value="Send"/>
      </form>
    </div>


    <div class="tbl-header">
      <table cellpadding="0" cellspacing="0" border="0">
        <thead>
          <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Date</th>
            <th>Options</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="tbl-content">
      <table cellpadding="0" cellspacing="0" border="0">
        <tbody>
          <?php foreach ($params['notes'] ?? [] as $note) : ?>
            <tr>
              <td><?php echo $note['id'] ?></td>
              <td><?php echo $note['title'] ?></td>
              <td><?php echo $note['created'] ?></td>
              <td>
                <a href="/?action=show&id=<?php echo $note['id'] ?>">
                  <button>Details</button>
                </a>
                <a href="/?action=delete&id=<?php echo $note['id'] ?>">
                  <button>Delete</button>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>
</div>