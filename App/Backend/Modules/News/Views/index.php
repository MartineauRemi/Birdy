<p style="text-align: center">Il y a actuellement <?= $newsNumber ?> news. En voici la liste :</p>

<table>
  <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php
foreach ($newsList as $news)
{
  echo '<tr><td>', $news['author'], '</td><td>', $news['title'], '</td><td>le ', $news['creationDate']->format('d/m/Y à H\hi'), '</td><td>', ($news['creationDate'] == $news['updateDate'] ? '-' : 'le '.$news['updateDate']->format('d/m/Y à H\hi')), '</td><td><a href="news-update-', $news['id'], '.html"><img src="/images/update.png" alt="Modifier" /></a> <a href="news-delete-', $news['id'], '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}
?>
</table>