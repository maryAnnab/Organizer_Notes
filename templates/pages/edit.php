<div>
  <h3>Ediding note</h3>
  <div>
    <?php if(!empty($params['note'])): ?>
    <?php dump($params); 
    $note = $params['note']; ?>
    <form class="note-form" action="/?action=edit" method="post">
      <input name="id" type="hidden" value="<?php echo $note['id'] ?>"/>
        <ul>
          <li>
            <label>Title <span class="required">*</span></label>
            <input type="text" name="title" class="field-long" value="<?php echo $note['title'] ?>" />
          </li>
          <li>
            <label>Contents</label>
            <textarea name="description" id="field5" class="field-long field-textarea"><?php echo $note 
            ['description'] ?></textarea>
          </li>
          <li>
            <input type="submit" value="Submit" />
          </li>
        </ul>
    </form>
    <?php else: ?>
      <div>
        Not enough data to show 
        <a href="/"><button>Back to the list of notes</button></a>
      </div>
    <?php endif; ?>
  </div>
</div>  