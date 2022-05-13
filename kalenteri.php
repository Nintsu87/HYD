<?php
class Calendar {

    private $active_year, $active_month, $active_day;
    private $events = [];

    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }

    public function add_event($txt, $date, $days = 1, $color = '') {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$txt, $date, $days, $color];
    }

    public function __toString() {

        $yy = $this->active_year;
        
        if ($this->active_month == '01') {
            $kk = 'Tammikuu';
        } elseif ($this->active_month == '02') {
            $kk = 'Helmikuu';
        } elseif ($this->active_month == '03') {
            $kk = 'Maaliskuu';
        } elseif ($this->active_month == '04') {
            $kk = 'Huhtikuu';
        } elseif ($this->active_month == '05') {
            $kk = 'Toukokuu';
        } elseif ($this->active_month == '06') {
            $kk = 'Kesäkuu';
        } elseif ($this->active_month == '07') {
            $kk = 'Heinäkuu';
        } elseif ($this->active_month == '08') {
            $kk = 'Elokuu';
        } elseif ($this->active_month == '09') {
            $kk = 'Syyskuu';
        } elseif ($this->active_month == '10') {
            $kk = 'Lokakuu';
        } elseif ($this->active_month == '11') {
            $kk = 'Marraskuu';
        } elseif ($this->active_month == '12') {
            $kk = 'Joulukuu';
        }
        $otsikko = $kk . "</br>" . $yy;
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Mon', 1 => 'Tue', 2 => 'Wed', 3 => 'Thu', 4 => 'Fri', 5 => 'Sat', 6 => 'Sun'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';
        $html .= '<ul>';
        $html .= '<button class="prev"><a href="prev.php">&#10094;</a></button>';
        $html .= '<button class="next"><a href="next.php">&#10095;</a></button>';
        $html .= $otsikko;
        $html .= '<ul>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="filler">';            
        $html .= '</div>';
        $html .= '<div class="days">';
        foreach ($days as $day) {
            if ($day == 'Mon') {
                $lyhenne = 'Ma';
            }
            elseif ($day == 'Tue') {
                $lyhenne = 'Ti';
            }
            elseif ($day == 'Wed') {
                $lyhenne = 'Ke';
            }
            elseif ($day == 'Thu') {
                $lyhenne = 'To';
            }
            elseif ($day == 'Fri') {
                $lyhenne = 'Pe';
            }
            elseif ($day == 'Sat') {
                $lyhenne = 'La';
            }
            elseif ($day == 'Sun') {
                $lyhenne = 'Su';
            }
            $html .= '
                <div class="day_name">
                    ' . $lyhenne . '
                </div>
            ';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month-$i+1) . '
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == $this->active_day) {
                $selected = ' selected';
            }
            $html .= '<div class="day_num' . $selected . '">';
            $html .= '<span>' . $i . '</span>';
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        if ($event[0] == 'Verenpaine') {
                            $html .= '<div class="event' . $event[3] . '">';
                            $html .= '<button><a href="./paine.php">'. $event[0] . '</a></button>';
                            $html .= '</div>';
                        } elseif ($event[0] == 'Verensokeri') {
                            $html .= '<div class="event' . $event[3] . '">';
                            $html .= '<button><a href="./verensokeri.php">'. $event[0] . '</a></button>';
                            $html .= '</div>';
                        } elseif ($event[0] == 'BMI') {
                            $html .= '<div class="event' . $event[3] . '">';
                            $html .= '<button><a href="./bmi.php">'. $event[0] . '</a></button>';
                            $html .= '</div>';
                        }
                    }
                }
            }
            $html .= '</div>';
        }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

}
?>
