<?php

/*  Copyright 2009-2011 Rafael Gutierrez Martinez
 *  Copyright 2012-2013 Welma WEB MKT LABS, S.L.
 *  Copyright 2014-2016 Where Ideas Simply Come True, S.L.
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

namespace providers\nabu\pdf\renders;
use nabu\core\CNabuEngine;
use nabu\http\app\base\CNabuHTTPApplication;
use nabu\http\interfaces\INabuHTTPResponseRender;
use nabu\http\renders\base\CNabuHTTPResponseRenderAdapter;
use nabu\render\CNabuRenderFactory;
use nabu\render\managers\CNabuRenderPoolManager;

/**
 * Class to dump HTML rendered as PDF as HTTP response.
 * @author Rafael Gutierrez <rgutierrez@nabu-3.com>
 * @since 0.0.1
 * @version 0.0.1
 * @package \providers\nabu\pdf\renders
 */
class CNabuPDFHTTPRender extends CNabuHTTPResponseRenderAdapter
{
    /** @var CNabuPDFRenderInterface PDF Render interface */
    private $nb_pdf_render_interface = null;

    public function __construct(
        CNabuHTTPApplication $nb_application,
        INabuHTTPResponseRender $main_render = null
    ) {
        parent::__construct($nb_application, $main_render);
    }

    public function render()
    {
        $nb_engine = CNabuEngine::getEngine();

        if (($nb_render_pool_manager = $nb_engine->getRenderPoolManager()) instanceof CNabuRenderPoolManager &&
            ($nb_render_factory = $nb_render_pool_manager->getFactory('application/pdf')) instanceof CNabuRenderFactory
        ) {
            $nb_render_factory->buildStringAsHTTPResponse(
<<< PDF
<page stye="font-size: 14px;">
    <h1>nabu-3 PDF Render test</h1>
    <p>This is a test of PDF Render Provider module to verify performance.</p>
</page>
PDF
                ,
                array(
                    'orientation' => 'P',
                    'size' => 'A4',
                    'language' => 'es'
                )
            );
        }
    }
}
