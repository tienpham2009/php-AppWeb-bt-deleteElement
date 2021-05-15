<form method="post">
    <input name="element" placeholder="nhap phan tu can xoa">
    <input type="submit" value="Delete">
</form>

<?php
$element = $_REQUEST["element"];

function getDataJson()
{
    $dataJson = file_get_contents("datas.json");
    return json_decode($dataJson);
}

function putDataJson($array)
{
    $dataJson = json_encode($array);
    file_put_contents("datas.json", $dataJson);
}

function checkElement($array, $element): bool
{
    $flag = false;
    for ($i = 0; $i < count($array); $i++) {
        if ($element == $array[$i]) {
            $flag = true;
        }
    }
    return $flag;
}


function deleteElement($array, $element): array
{
    $newArray[0] = $array;
    if (checkElement($array, $element) == true) {
        for ($i = 0; $i < count($array); $i++) {
            if ($element == $array[$i]) {
                $index = $i;
                for ($j = $index; $j < count($array); $j++) {
                    $array[$j] = $array[$j + 1];
                }
            }
        }

    } else {
        echo "Not find Element"."<br>";
    }
    array_push($newArray, $array);
    return $array;
}

$newArray = deleteElement(getDataJson(), $element);
putDataJson($newArray);
echo implode(",", $newArray);
?>


