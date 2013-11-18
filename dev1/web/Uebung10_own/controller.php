<?php

class Controller {

    private $model;
    private $view;

    public function __construct($post, $get) {

        $this->view = new view();

        // prüfen, welche Funktion aufgerufen werden soll
        switch ($get["service"]) {
            case 'kantone':

            $this->showAllKanton();
            if (isset($get["methode"])) {
                switch ($get["methode"]) {
                    case 'list':
                        if(isset($get["sort"])){
                            $this->showSortedList($get["sort"]);
                        }
                        else{
                            $this->showNoGet();
                        }

                        break;

                    case 'single';
                        if(isset($get["id"])){
                            $this->showKanton($get["id"]);
                        }

                    default:
                        $this->showNoGet();
                        break;
                }
                    $this->show($get["id"]);
                } else {
                    $this->showNoGet();
                }

                break;

                break;
            default:
                $this->showNoGet();
        }

    }

    // http://localhost/kantone/resolver.php?service=kantone&methode=list&sort=name
    //
    // http://localhost/kantone/resolver.php?service=kantone&methode=single&id=zh

    public function showAll() {
        foreach (model::getEntries() as $entry) {
            $this->view->displayEntry($entry);
        }
    }

     public function showAllKanton() {
        foreach (model::getEntries() as $entry) {
            $this->view->displayEntry($entry);
        }
    }

    public function show($id) {
        $this->view->displayEntry(model::getEntry($id-1)); // id um eines erhöhen, da das Array mit 0 startet
    }

    public function showNoGet() {
        $this->view->displayText("No valid GET parm!");
    }

    public function edit($id) {
        model::editEntries($id, "Neuer Titel", "Neuer Content");
    }

}





?>