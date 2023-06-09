<!DOCTYPE html>
<html>
  <head>
    <title>검색 결과</title>
  </head>
  <body>
    <form method="GET">
      <label for="search-term">검색어:</label>
      <input type="text" id="search-term" name="search_term">
      <select name="search_field">
        <option value="students_id">ID</option>
        <option value="students_number">학번</option>
        <option value="students_name">이름</option>
        <option value="students_tall">키</option>
        <option value="students_weight">몸무게</option>
        <option value="students_gender">성별</option>
      </select>
      <button type="submit">검색</button>
    </form>
  </body>
</html>

<?php
$host = 'localhost';
$user = 'viewer';
$pass = 'password';
$db = 'schoolpe';
$connect = mysqli_connect($host, $user, $pass, $db);

$search_term = $_GET['search_term'];
$search_field = $_GET['search_field'];

$sql = "SELECT * FROM students WHERE $search_field LIKE '%$search_term%'";
$result = mysqli_query($connect, $sql);

if (!isset($_GET['search_term']) || empty($_GET['search_term'])) {
  echo "검색어를 입력하세요.";
  exit;
} 

if (!$result) {
  echo "SQL 구문에 오류가 있습니다.";
  exit;
} 

if (!$connect) {
  die("데이터베이스 연결 실패: " . mysqli_connect_error());
}

if (mysqli_num_rows($result) == 0) {
  echo "검색 결과가 없습니다.";
} else {
  echo "<table>";
  echo "<thead><tr><th>ID</th><th>학번</th><th>이름</th><th>키</th><th>몸무게</th><th>성별</th></tr></thead>";
  echo "<tbody>";
  while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['students_id'] . "</td>";
      echo "<td>" . $row['students_number'] . "</td>";
      echo "<td>" . $row['students_name'] . "</td>";
      echo "<td>" . $row['students_tall'] . "</td>";
      echo "<td>" . $row['students_weight'] . "</td>";
      echo "<td>" . $row['students_gender'] . "</td>";
      echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
}

mysqli_close($connect);
?>
