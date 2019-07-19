<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Report</title>
  </head>
  <body style="margin-top: 0px">

    $html = '<h1>Hello World</h1>';

    PDF::SetTitle('Hello World');
    PDF::AddPage();
    PDF::writeHTML($html, true, false, true, false, '');

    PDF::Output('hello_world.pdf');
    รายงานนะครับ

  </body>
</html>
