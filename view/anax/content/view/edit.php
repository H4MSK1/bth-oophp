<form method="post">
    <div class="col-12 col-sm-12 col-md-8 offset-md-2">
        <legend>Edit</legend>
        <input type="hidden" name="contentId" value="<?= esc($content->id) ?>"/>

        <div class="form-group">
            <label>Title:</label>
            <br>
            <input class="form-control" type="text" name="contentTitle" value="<?= esc($content->title) ?>"/>
        </div>

        <div class="form-group">
            <label>Path:</label>
            <br>
            <input class="form-control" type="text" name="contentPath" value="<?= esc($content->path) ?>"/>
        </div>

        <div class="form-group">
            <label>Slug:</label>
            <br>
            <input class="form-control" type="text" name="contentSlug" value="<?= esc($content->slug) ?>"/>
        </div>

        <div class="form-group">
            <label>Text:</label>
            <br>
            <textarea class="form-control" name="contentData"><?= esc($content->data) ?></textarea>
         </div>

         <div class="form-group">
            <label>Type:</label>
            <br>
            <input class="form-control" type="text" name="contentType" value="<?= esc($content->type) ?>"/>
         </div>

         <div class="form-group">
            <label>Filter:</label>
            <br>
            You can choose one or more of: <i><?= join(", ", $filter->getFiltersName()) ?></i>
            <br>
            <input class="form-control" type="text" name="contentFilter" value="<?= esc($content->filter) ?>"/>
         </div>

         <div class="form-group">
             <label>Publish:</label>
             <br>
             <input class="form-control" type="datetime" name="contentPublish" value="<?= esc($content->published) ?>"/>
         </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
            <button class="btn btn-primary" type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
            <button class="btn btn-primary" type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
        </div>
    </div>
</form>
