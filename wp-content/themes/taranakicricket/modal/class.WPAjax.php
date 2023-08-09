<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/25/2023
 * Time: 1:43 PM
 */
class WPAjax
{
    private $success = 0;
    private $error = 0;
    private $response = 0;

    function __construct($function)
    {
        if (method_exists($this, $function)) {
            // Runt he function
            $this->$function();
        } else {
            $this->error = 1;
            $this->response = 'Function not found for ' . $function;
        }
        echo $this->getResponse();
        session_write_close();
        exit;
    }

    public function getResponse()
    {
        // Prepare response array
        $json = Array(
            'success' => $this->success,
            'error' => $this->error,
            'response' => $this->response
        );
        $output = $json['response'];

        return $output;
    }
    private function filterRecords()
    {
        $filter = $_REQUEST['filter'];
        $honours = getHonoursByType($filter);
        //$this->response = getWebinarEvents($filter, $post_id);
        $html = '
        <table class="table table-striped results">
            <thead>
            <tr>
                <th scope="col">Year</th>
                <th scope="col">Player</th>
                <th scope="col">Performance</th>
                <th scope="col">VS</th>
                <th scope="col">Scorecard</th>
            </tr>
            <tr class="warning no-result">
                <td colspan="5"><i class="fa fa-warning"></i> No player found</td>
            </tr>
            </thead>
            <tbody>';
            foreach ($honours as $record) {
                $html .= '
            <tr>
                <td>' . $record->getYear() . '</td>
                <td>' . $record->getPlayer() . '</td>
                <td>' . $record->getPerformance() . '</td>
                <td>' . $record->getOpponent() . '</td>
                <td>' . $record->getScorecard() . '</td>
            </tr>';
            }
            $html .= '
            </tbody>
        </table>';
        $this->response = $html;
    }
}