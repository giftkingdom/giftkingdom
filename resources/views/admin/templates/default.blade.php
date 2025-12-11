 <div class="form-group">

    <label for="content" class="control-label mb-1">Content</label>

    <textarea class="quilleditor" name="content" height="535">

      <?php

      if(isset($result['content']['content'])) :

         echo $result['content']['content'];
         
      endif;

      ?>

    </textarea>

</div>