<?php
include 'includes/connection.php'; // Make sure to include your database connection
$master = @$_GET['master'];

$i = 0;
$sql = "SELECT q.id, q.question 
FROM questions q 
LEFT JOIN answers a ON q.id = a.qID 
WHERE a.qID IS NULL AND q.categoryID = '$master'
ORDER BY RAND() 
LIMIT 5;
";
$query = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($query)) {
    $id = $row['id'];
    $question = $row['question'];
    $i++;
    echo "<tr class='border-b border-gray-200'>
            <td class='px-4 py-4 whitespace-nowrap'>$i</td>
            <td class='px-4 py-4'>$question</td>
            <td class='px-4 py-4 whitespace-nowrap'>
                <a href='answer.php?id=$id' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2'>Pick</a>
            </td>
          </tr>";
}
