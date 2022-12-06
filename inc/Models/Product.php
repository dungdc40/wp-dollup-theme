<?php
namespace Du\Models;

class Product extends Base
{
    public function filter($brand=null, $color=null, $size=null, $fromDate=null, $toDate=null) {
        $sql = "SELECT * FROM product";

        $where = [];
        $params = [];

        if($brand) {
            $where[] = 'brand_id=%d';
            $params[] = $brand;
        }

        if($color) {
            $where[] = 'color_id=%d';
            $params[] = $color;
        }

        if($size) {
            $where[] = 'size_id=%d';
            $params[] = $size;
        }

        if($fromDate) {
            $booked = $this->getProductsBooked($fromDate, $toDate);
            $bookedIds = array_column($booked, 'id');
            $bookedIds = array_unique($bookedIds);
            if($bookedIds) {
                $bookedIdsString = implode(',', $bookedIds);
                $where[] = "id NOT IN ($bookedIdsString)";
            }
        }
        $where = $where ? " WHERE " . implode(' AND ', $where) : "";
        $sql = $sql . $where;
        $prepared = $this->db->prepare($sql, $params);
        return $this->db->get_results($prepared);
    }

    /**
     * Get products booked in date range
     * @param string $fromDate
     * @param string $toDate
     * @return array
     */
    public function getProductsBooked($fromDate, $toDate) {
        if(!$fromDate || !$toDate) {
            throw new \Exception("Bạn phải chọn cả ngày bắt đầu và kết thúc");
        }

        $sql = "SELECT p.* FROM `order` o INNER JOIN order_item oi ON oi.order_id=o.id INNER JOIN product p ON p.id=oi.product_id WHERE " .
                "o.date_in <= %s AND o.date_out >= %s";

        $prepared = $this->db->prepare($sql, [$toDate, $fromDate]);
        return $this->db->get_results($prepared);
    }
}