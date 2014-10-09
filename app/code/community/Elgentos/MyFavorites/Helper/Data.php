<?php
class Elgentos_MyFavorites_Helper_Data extends Mage_Core_Helper_Abstract {
    public function calculateFavorites($customer) {
        if (!$customer instanceof Mage_Customer_Model_Customer) return array();
        $orderCollection = Mage::getModel('sales/order')->getCollection();
        $orderCollection->getSelect()->where('customer_id =' . $customer->getId());
        $products = $orderIds = array();
        if ($orderCollection && count($orderCollection) > 0) {
            foreach ($orderCollection as $order) {
                $orderIds[] = $order->getId();
            }
        }
        if (count($orderIds)) {
            $orderItemCollection = Mage::getModel('sales/order_item')->getCollection();
            $orderItemCollection->getSelect()->where('order_id IN (' . implode(',', $orderIds) . ')');
            if ($orderItemCollection && count($orderItemCollection) > 0) {
                foreach ($orderItemCollection as $item) {
                    @$products[$item->getSku() ]++;
                }
            }
        }
        arsort($products);
        return $products;
    }
}
