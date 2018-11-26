<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <form action="foto_post.php" method="POST" enctype="multipart/form-data">
            <table width="350" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#000000">
                <tr>
                    <td height="85" align="center" valign="middle" bgcolor="#FFFFFF">
                        <div align="center">
                            <input class="text-center" name="nombre" id="nombre">
                            <input id="imagen" name="imagen" type="file" maxlength="150">
                            <br><br>
                            <input type="submit" value="Agregar" name="enviar" style="cursor: pointer">
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    <div><img src="img/Wallpapers-HD.jpg" ></div>
    </body>
</html>