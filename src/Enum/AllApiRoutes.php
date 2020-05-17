<?php

namespace App\Enum;

use Greg0ire\Enum\AbstractEnum;

/**
 * Class AllApiRoutes
 */
abstract class AllApiRoutes extends AbstractEnum {
    const LOGIN = 'Login';
    
    const HOME_PAGE = 'HomePage';
    
    const LIST_PROJECTS = 'ListProjects';
    
    const MODEL_STEP = 'ModelStep';
    
    const SURFACE_STEP = 'SurfaceStep';
    
    const OPTIONS_STEP = 'OptionsStep';
    
    const SUMMARY_STEP = 'SummaryStep';
}
