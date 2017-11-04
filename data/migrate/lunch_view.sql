SELECT
  `slw`.`id` AS `id`,
  DATE_FORMAT(`slw`.`start_date`, '%Y-%m-%d') AS `do_start`,
  ((DATE_FORMAT(`slw`.`end_date`, '%d.%m.%Y') - DATE_FORMAT(`slw`.`start_date`, '%d.%m.Y')) + 1) AS `days`,
  (`slw`.`dotation` / ((DATE_FORMAT(`slw`.`end_date`, '%d.%m.%Y') - DATE_FORMAT(`slw`.`start_date`, '%d.%m.Y')) + 1)) AS `dotation`,
  1 AS `is_closed`,
  DATE_FORMAT(`slw`.`public_date`, '%d.%m.%Y') AS `do_publish`
FROM `portal`.`sodis_lunch_week` `slw`
WHERE ((`slw`.`dotation` IS NOT NULL)
AND (`slw`.`public_date` IS NOT NULL)
AND (((DATE_FORMAT(`slw`.`end_date`, '%d.%m.%Y') - DATE_FORMAT(`slw`.`start_date`, '%d.%m.Y')) + 1) < 6))
ORDER BY DATE_FORMAT(`slw`.`start_date`, '%Y-%m-%d') DESC
