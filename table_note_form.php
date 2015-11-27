<?php include "kon/kon.php"; $tables=new Tables(); ?>

    <form id="table_note_form" name="form2" method="post" action="table_note_insert.php">
        <div class="form-group">
            <label>Note Id</label>
            <input name='note_id' id='note_id' class='form-control' placeholder='Enter Note Id'>
            <label>Subtask Id</label>
            <input name='subtask_id' id='subtask_id' class='form-control' placeholder='Enter Subtask Id'>
            <label>Note</label>
            <input name='note' id='note' class='form-control' placeholder='Enter Note'>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
        <button type="reset" class="btn btn-default">Reset</button>
     </form>
    <script src="table_note_insert.js" type="text/javascript"></script>
