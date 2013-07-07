<!doctype html>
<html>
<head>
<title>simple_cursor</title>
<!-- <link rel="stylesheet" href="simple_cursor.css"> -->
<link rel="stylesheet" href="css/graph.css">
</head>
<body>
<!-- <pre>
<div class="cursor"> </div>
</pre> -->

<form id="formular" action="vl.php" method="post">
    <table border="0">

      <tr>
        <td><b>Inšpektor / Meno*:</b></td>
        <td><input type="text" class="rounded" id="username" name="username"  maxlength="50" size="20" /></td>
        <td id="formular_username_errorloc"> </td>
      </tr>

      <tr>
        <td><b>Text správy*:</b></td>
        <td> <textarea name="password" cols="50" rows="6" class="rounded" style="width:350px;margin-left:2px;"></textarea>
        </td>
        <td id="formular_password_errorloc"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">
          <input id="submit" type="submit" class="rounded" value="Odoslať"></td>
        <td></td>
      </tr>
    </table>
  </form>
</body>
</html>