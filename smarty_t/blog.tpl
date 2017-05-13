<table>
{foreach $data as $blog}
    <tr>
        <td>{$blog->title}</td>
        <td>{$blog->description}</td>
        <td>{$blog->date_created->format('Y-m-d')}</td>
    </tr>
{/foreach}
</table>