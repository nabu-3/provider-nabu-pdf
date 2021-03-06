<?php

/*  Copyright 2009-2011 Rafael Gutierrez Martinez
 *  Copyright 2012-2013 Welma WEB MKT LABS, S.L.
 *  Copyright 2014-2016 Where Ideas Simply Come True, S.L.
 *  Copyright 2017 nabu-3 Group
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

namespace providers\nabu\pdf;
use nabu\core\CNabuEngine;
use nabu\core\interfaces\INabuApplication;
use nabu\http\app\base\CNabuHTTPApplication;
use nabu\http\managers\CNabuHTTPRenderDescriptor;
use nabu\render\adapters\CNabuRenderModuleManagerAdapter;
use nabu\render\descriptors\CNabuRenderInterfaceDescriptor;
use nabu\render\descriptors\CNabuRenderTransformInterfaceDescriptor;

 /**
  * @author Rafael Gutierrez <rgutierrez@nabu-3.com>
  * @since 0.0.1
  * @version 0.0.1
  * @package \providers\nabu\pdf
  */
class CNabuPDFProviderManager extends CNabuRenderModuleManagerAdapter
{
    /** @var CNabuRenderInterfaceDescriptor PDF Render descriptor. */
    private $nb_pdf_render_descriptor = null;
    /** @var CNabuRenderTransformInterfaceDescriptor HTML to PDF Render Transform descriptor. */
    private $nb_pdf_render_transform_descriptor = null;

    /**
     * Default constructor.
     */
    public function __construct()
    {
        parent::__construct(NABU_PDF_VENDOR_KEY, NABU_PDF_MODULE_KEY);
    }

    public function enableManager()
    {
        $nb_engine = CNabuEngine::getEngine();

        /*
        $this->nb_pdf_render_descriptor = new CNabuRenderInterfaceDescriptor(
            $this,
            'NabuPDFRender',
            'Nabu PDF Render',
            __NAMESPACE__,
            'CNabuPDFRenderInterface',
            'application/pdf'
        );
        $nb_engine->registerProviderInterface($this->nb_pdf_render_descriptor);
        */
        $this->nb_pdf_render_transform_descriptor = new CNabuRenderTransformInterfaceDescriptor(
            $this,
            'NabuPDFRenderTransform',
            'nabu-3 Transform HTML to PDF',
            __NAMESPACE__,
            'CNabuPDFRenderTransformInterface',
            'application/pdf'
        );
        $nb_engine->registerProviderInterface($this->nb_pdf_render_transform_descriptor);

        return true;
    }

    public function registerApplication(INabuApplication $nb_application)
    {
        /*
        if ($nb_application instanceof CNabuHTTPApplication) {
            $this->nb_application = $nb_application;
            $this->nb_application->registerRender(
                (new CNabuHTTPRenderDescriptor())
                    ->setKey('PDF')
                    ->setClassName('providers\nabu\pdf\renders\CNabuPDFHTTPRender')
            );
        }
        */

        return $this;
    }
}
