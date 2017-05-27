<?php

    require_once "bootstrap.php";
    require_once "utility.php";


    /*
     * function defaultPage
     *
     * return: array page[title, content]
     */
    function defaultPage()
    {
        $title = 
            '<title>Super User Page Manager</title>';
        $content =
            'Liste des utilisateurs : 
            <tr>
                <td>ID</td>
                <td>User</td>
                <td>Suppr</td>
                <td>Link Article</td>
            </tr>'
        $vue =
            for ($_ID_ = 1; $_ID_ <= 40 ; $_ID_++) 
            {
            
                $_id_user_ = sendRequest($entityManager, 'SELECT id.user FROM User where id.user='.$_ID_.'');
                $_name_ = sendRequest($entityManager, 'SELECT user.user FROM User where id.user='.$_ID_.'');
                $_articles_ = sendRequest($entityManager, 'SELECT id FROM Article where author.Article like'.$_user_.'');
                
                '<tr>
                    <td>'$_id_user_'</td>'
                    '<td>'$_name_'</td>'
                    '<td><a href="articleForm.php">'$_articles_'</a></td>
                </tr>'  
            }   
            
        $supprimer =
            '<form action="/formulaire_delete.php" method="post">
              ID à supprimer:<br>
              <input type="integer" name="id"><br>
              <input type="submit" value="Submit">
            </form>'
        return [$title, $content, $vue, $supprimer];
        
    }

    defaultPage();
    

?>