-- 2023.12.27 已添加到 migration迁移文件
ALTER TABLE `attr_value`
	ADD COLUMN `is_delete` tinyint(1) NOT NULL DEFAULT 0 AFTER `attr_vsort`;
ALTER TABLE `shop_shipper`
	ADD COLUMN `shop_id` int(11) NOT NULL DEFAULT 0 COMMENT '店铺ID' AFTER `id`;
