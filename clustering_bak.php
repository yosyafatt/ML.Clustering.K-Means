<?php     
    include 'functions.php';

    $data = getData("ruspini.txt");    

    $n_data   = count($data);
    $n_dim    = count($data[0]);    

    $k = 5;
    $centroid_a[][] = '';    
    $centroid_b[][] = '';
    $cluster[] = '';
    $jarak[] = '';
    $n_member[] = '';

    $selisih = 0.0;
    $iterasi = 0;

    do {
        $iterasi++;
        for ($i=0; $i < $k; $i++) { 
            for ($j=0; $j < $n_dim; $j++) { 
                $centroid_a[$i][$j] = rand(4,160);
            }
        }    

        for ($i=0; $i < $k; $i++) { 
            for ($j=0; $j < $n_dim; $j++) { 
                $centroid_b[$i][$j] = $centroid_a[$i][$j];
                $centroid_a[$i][$j] = 0;
            }
        }

        for ($i=0; $i < $k; $i++) { 
            $n_member[$i] = 0;
        }

        for ($i=0; $i < $n_data; $i++) { 
            $idxmin     = -1;
            $nilaimin   = 1000000;

            for ($j=0; $j < $k; $j++) { 
                $jarak[$j] = 0;
                for ($m=0; $m < $n_dim; $m++) { 
                    $jarak[$j] = pow($data[$i][$m] - $centroid_a[$j][$m], 2);
                }
                $jarak[$j] = sqrt($jarak[$j]);

                if($jarak[$j] < $nilaimin){
                    $idxmin     = $j;
                    $nilaimin   = $jarak[$j];
                }            
            }

            $cluster[$i] = $idxmin;
            $n_member[$cluster[$i]]++;

            for ($m=0; $m < $n_dim; $m++) { 
                $centroid_a[$cluster[$i]][$m] += $data[$i][$m];
            }
        }

        $selisih = 0.0;
        for ($i=0; $i < $k; $i++) { 
            for ($m=0; $m < $n_dim; $m++) { 
                @($centroid_a[$i][$m] /= $n_member[$i]);
                $selisih += abs($centroid_a[$i][$m] - $centroid_b[$i][$m]);
            }
        }
    } while ($selisih > 0.1);

    print_r($cluster);
?>