<?php if ($data): ?><ul>
 <?php foreach ($data as $category): ?><li id="category_<?php echo $category['Category']['id']; ?>"><span><?php echo $category['Category']['name']; ?></span>
 <?php echo $this->element('draw_category', array('data' => $category['children'])); ?>
 </li><?php endforeach; ?>
</ul><?php endif; ?>