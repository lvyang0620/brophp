<!DOCTYPE html>
<html>
  <head>
    <title>上传文件</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <form id="upload" action="<{$url}>/uploadEx" method="post" enctype="multipart/form-data">
      <label for="file">上传文件:</label>
      <input type="file" name="file" id="file"><br />
      <input type="submit" name="submit" value="上传" />
    </form>
  </body>
</html>
