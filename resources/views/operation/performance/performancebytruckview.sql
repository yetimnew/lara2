(
    SELECT
        `tims_laravel`.`trucks`.`id` AS `id`,
        `tims_laravel`.`trucks`.`plate` AS `plate`,
        `tims_laravel`.`driver_truck`.`id` AS `dt_id`,
        `tims_laravel`.`driver_truck`.`id` AS `dtplate`,
        `tims_laravel`.`drivers`.`name` AS `name`,
        `tims_laravel`.`performances`.`DateDispach` AS `DateDispach`,
        COUNT(
            `tims_laravel`.`performances`.`FOnumber`
        ) AS `fo`,
        SUM(
            `tims_laravel`.`performances`.`CargoVolumMT`
        ) AS `CargoVolumMT`,
        SUM(
            `tims_laravel`.`performances`.`DistanceWCargo`
        ) AS `TDWC`,
        SUM(
            `tims_laravel`.`performances`.`DistanceWOCargo`
        ) AS `TDWOC`,
        SUM(
            `tims_laravel`.`performances`.`tonkm`
        ) AS `tonkm`,
        SUM(
            `tims_laravel`.`performances`.`fuelInLitter`
        ) AS `fl`,
        SUM(
            `tims_laravel`.`performances`.`fuelInBirr`
        ) AS `fB`
    FROM
        (
            (
                (
                    `tims_laravel`.`performances`
                LEFT JOIN `tims_laravel`.`driver_truck` ON
                    (
                        `tims_laravel`.`driver_truck`.`id` = `tims_laravel`.`performances`.`driver_truck_id`
                    )
                )
            LEFT JOIN `tims_laravel`.`drivers` ON
                (
                    `tims_laravel`.`drivers`.`id` = `tims_laravel`.`driver_truck`.`id`
                )
            )
        LEFT JOIN `tims_laravel`.`trucks` ON
            (
                `tims_laravel`.`trucks`.`id` = `tims_laravel`.`performances`.`driver_truck_id`
            )
        )
    WHERE
        `tims_laravel`.`performances`.`trip` = 1
    GROUP BY
        `tims_laravel`.`trucks`.`plate`
    ORDER BY
        SUM(
            `tims_laravel`.`performances`.`tonkm`
        )
    DESC
)