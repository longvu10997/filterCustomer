<?php
$customerList = [
    '1' => [
        "name" => "Chaien",
        "birthday" => "1983/08/20",
        "address" => "Hà Nội",
        "profile" => "image/chaien.png",
    ],
    '2' => [
        "name" => "Doraemon",
        "birthday" => "1983/08/21",
        "address" => "Bắc Giang",
        "profile" => "image/doraemon.png",
    ],
    '3' => [
        "name" => "Nobita",
        "birthday" => "1983/08/22",
        "address" => "Nam Định",
        "profile" => "image/nobita.png",
    ],
    '4' => [
        "name" => "Shizuka",
        "birthday" => "1983/08/17",
        "address" => "Hà Tây",
        "profile" => "image/shizuka.png",
    ],
    '5' => [
        "name" => "Xeko",
        "birthday" => "1983/07/13",
        "address" => "Hà Nội",
        "profile" => "image/xeko.png",
    ],
];
function searchByDate($customers, $fromDate, $toDate): array
{
    if (empty($fromDate) || empty($toDate)) {
        return $customers;
    }

    $filteredCustomers = [];
    foreach ($customers as $customer) {
        if (strtotime($customer['birthday']) < strtotime($fromDate))
            continue;
        if (strtotime($customer['birthday']) > strtotime($toDate))
            continue;
        $filteredCustomers[] = $customer;
    }
    return $filteredCustomers;
}

$fromDate = $_REQUEST["from"] ?? null;  //cú pháp a ?? b (nếu không tồn tại a thì giá trị sẽ nhận b
$toDate =  $_REQUEST["to"]?? null;

$filteredCustomers = searchByDate($customerList, $fromDate, $toDate);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Customers filter</title>
    <link type="text/css" rel="stylesheet" href="index.css"/>
</head>
<body>
<form method="GET">
    Chọn ngày sinh từ: <input id="from" type="date" name="from" placeholder="yyyy/mm/dd"
                              value="<?php echo $fromDate ?? ''; ?>"/>
    đến: <input id="to" type="date" name="to" placeholder="yyyy/mm/dd"
                value="<?php echo $toDate ?? ''; ?>"/>
    <input type="submit" id="submit" value="Lọc"/>
</form>
<table>
    <caption><h2>Danh sách khách hàng</h2></caption>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Địa chỉ</th>
        <th>Ảnh</th>
    </tr>
    <?php foreach ($filteredCustomers as $index => $customer): ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo $customer['name']; ?></td>
            <td><?php echo $customer['birthday']; ?></td>
            <td><?php echo $customer['address']; ?></td>
            <td>
                <div class="profile"><img src="<?php echo $customer['profile']; ?>"/></div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>