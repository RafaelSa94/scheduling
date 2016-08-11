<?php
require_once('../model/SubjectClass.php');
require_once '../app_configs.php';

/**
 * Utilitários
 */
class Utils
{
    static public function classesToCsv(array $classes)
    {
        $vertices = array();
        for ($i=0; $i < count($classes); $i++) {
            $vertex = "";
            /** @var SubjectClass $c */
            $c = $classes[$i];
            if (!($c instanceof SubjectClass))
            return 0;

            $vertex .= $i.";";

            $edges = array();
            for ($j=0; $j < count($classes); $j++) {
                /** @var SubjectClass $d */
                $d = $classes[$j];

                if ($i != $j &&
                    ($c->getSemester() == $d->getSemester() ||
                    $c->getProfessor()->getId() == $d->getProfessor()->getId())) {
                    array_push($edges, $j);
                }
            }
            $vertex .= implode(",", $edges) . ";";

            // Corrige para funcionar com o programa em C++
            $constraints = $c->getProfessor()->getConstraints();
            $constraints = array_map(function($x){return $x==null?null:$x-1;}, $constraints);

            $vertex .= implode(",", $constraints).";";

            array_push($vertices, $vertex);
        }

        return implode("\n", $vertices);
    }

    static public function getTimetable(array $classes)
    {
        $cmd = Config::executable." /dev/stdin /dev/stdout";

        $descriptorspec = array(
           0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
           1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
        );

        $process = proc_open($cmd, $descriptorspec, $pipes);

        fwrite($pipes[0], Utils::classesToCsv($classes));
        fclose($pipes[0]);

        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);

        proc_close($process);

        return $output;
    }

}
