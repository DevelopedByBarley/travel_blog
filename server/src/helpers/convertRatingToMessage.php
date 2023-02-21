<?php
    function convertRatingToMessage($rating) {
        switch ($rating) {
            case 1:
                $ratingMessage = "Rossz élmény,  senkinek sem ajánlom!";
                break;
            case 2:
                $ratingMessage = "Rossz volt, de rosszabbul is járhattam volna!";
                break;
            case 3:
                $ratingMessage = "Nem volt rossz, de ha van más választásod nem ajánlanám!";
                break;
            case 4:
                $ratingMessage = "Kellemes élmény volt, menj el havan rá lehetőséged!";
                break;
            case 5:
                $ratingMessage = "Nagyszerű élmény volt, mindenképp menj el!";
                break;
            default:
                null;
        }

        return $ratingMessage;
    }
