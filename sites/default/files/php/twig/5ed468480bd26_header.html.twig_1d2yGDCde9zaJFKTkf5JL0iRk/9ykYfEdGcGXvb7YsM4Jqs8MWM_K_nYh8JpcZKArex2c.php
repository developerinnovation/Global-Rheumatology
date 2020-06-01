<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @basic/header.html.twig */
class __TwigTemplate_c5238fd51845ddcbe734de02086544ec3377f5dc833747cb63848035f7007068 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 1, "if" => 3, "trans" => 71, "for" => 93];
        $filters = ["escape" => 7];
        $functions = ["simplify_menu" => 1, "drupal_view" => 34];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'trans', 'for'],
                ['escape'],
                ['simplify_menu', 'drupal_view']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $context["items"] = call_user_func_array($this->env->getFunction('simplify_menu')->getCallable(), ["menu-principal"]);
        // line 2
        echo "
<header id=\"header\" class=\"";
        // line 3
        if (($context["is_front"] ?? null)) {
            echo "home";
        } else {
            echo "not-home";
        }
        echo "\">
    <div class=\"container\">
        <div class=\"left\">
            <div class=\"lang\">
                ";
        // line 7
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "lang", [])), "html", null, true);
        echo "
            </div>
            <div class=\"search\">
                <a href=\"/search/content/by/type\">
                    <img src=\"/";
        // line 11
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null)), "html", null, true);
        echo "/images/icon-search.svg\" class=\"ico icon-search ";
        if ( !($context["is_front"] ?? null)) {
            echo "no-front";
        }
        echo " \" alt=\"buscar\" width=\"40\" height=\"40\" />
                </a>
            </div>
        </div>
        <div id=\"logo\">
            ";
        // line 16
        if (($context["is_front"] ?? null)) {
            // line 17
            echo "                <a href=\"/\">
                    <img src=\"/";
            // line 18
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null)), "html", null, true);
            echo "/images/logo-blanco.svg\" class=\"logo home\" alt=\"Global Rheumaatology\" width=\"200\" height=\"200\" />
                </a>
            ";
        } else {
            // line 21
            echo "                <a href=\"/\">
                    <img src=\"/";
            // line 22
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null)), "html", null, true);
            echo "/images/logo-color.svg\" class=\"logo not-home\" alt=\"Global Rheumaatology\" width=\"200\" height=\"200\" />
                </a>
            ";
        }
        // line 25
        echo "        </div>
        <div class=\"right\">
            <!--<div class=\"notification\">
                <span class=\"ico icon-notification\"></span>
                <span class=\"counter\">+1</span>
            </div>-->
            <div class=\"user\">
                <a href=\"/user\">
                    ";
        // line 33
        if (($context["logged_in"] ?? null)) {
            // line 34
            echo "                        ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("usuarios", "block_1"), "html", null, true);
            echo "
                    ";
        } else {
            // line 36
            echo "                        <img src=\"/themes/custom/basic/images/invitado.jpg\" title=\"Usuario invitado\"  class=\"img-responsive img-circle\" width=\"40\" height=\"40\"/>
                    ";
        }
        // line 38
        echo "                </a>
            </div>
            <div class=\"box icon-menu\">
                <button id=\"btn-menu\">Menu</button>
            </div>
        </div>        
        <!--<div class=\"box-notification\">
            <ul>
                <li>
                    <a href=\"\">Envía un artículo</a>
                </li>
                <li>
                    <a href=\"\">Completa tu perfil</a>
                </li>
                <li>
                    <a href=\"\">test</a>
                </li>
            </ul>
        </div>-->
        <div class=\"box-menu\">
            <div class=\"user\">            
                ";
        // line 59
        if (($context["logged_in"] ?? null)) {
            // line 60
            echo "                ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("usuarios", "block_1"), "html", null, true);
            echo "
                ";
        } else {
            // line 62
            echo "                    <img src=\"/themes/custom/basic/images/invitado.jpg\" title=\"Usuario invitado\"  class=\"img-responsive img-circle\" width=\"40\" height=\"40\"/>
                ";
        }
        // line 64
        echo "                <div class=\"info\">                
                    ";
        // line 65
        if (($context["logged_in"] ?? null)) {
            // line 66
            echo "                        <span class=\"nombre\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["user"] ?? null), "nombres", [])), "html", null, true);
            echo "</span>
                        <a class=\"editar\" href=\"/user/";
            // line 67
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["user"] ?? null), "id", [])), "html", null, true);
            echo "\">Mi perfil</a>
                        <a class=\"editar\" href=\"/user/";
            // line 68
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["user"] ?? null), "id", [])), "html", null, true);
            echo "/edit\">Editar perfil</a>
                        <a class=\"editar\" href=\"/user/logout\">Cerrar sesión</a>
                    ";
        } else {
            // line 71
            echo "                        <span class=\"nombre\">";
            echo t("Invitado", array());
            echo "</span>
                    ";
        }
        // line 73
        echo "                </div>   
            </div>
            
            <nav>
                <ul> <!-- menu principal -->
                    ";
        // line 78
        if ((($context["logged_in"] ?? null) != true)) {
            // line 79
            echo "                        <li class=\" navigation__item\">
                            <a href=\"/user/login\" class=\"\">";
            // line 80
            echo t("Iniciar sesión", array());
            echo "</a>
                        </li>
                    ";
        }
        // line 83
        echo "
                    ";
        // line 84
        if (($context["logged_in"] ?? null)) {
            // line 85
            echo "                        <li class=\" navigation__item\">
                            <a href=\"/new/send/manuscrito\" class=\"\">";
            // line 86
            echo t("Publicar", array());
            echo "</a>
                        </li>
                        <li class=\" navigation__item\">
                            <a href=\"/show/saved/content\" class=\"\">";
            // line 89
            echo t("Artículos guardados", array());
            echo "</a>
                        </li>
                    ";
        }
        // line 92
        echo "                    
                    ";
        // line 93
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["items"] ?? null), "menu_tree", []));
        foreach ($context['_seq'] as $context["_key"] => $context["menu_item"]) {
            echo "                        
                        <li class=\"";
            // line 94
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["item_class"] ?? null)), "html", null, true);
            echo " main navigation__item ";
            if ($this->getAttribute($context["menu_item"], "submenu", [])) {
                echo "submenu";
            }
            echo "\" ";
            if ((($this->getAttribute($context["menu_item"], "url", []) == "/new/send/manuscrito") && (($context["logged_in"] ?? null) != true))) {
                echo " style=\"display:none\" ";
            }
            echo ">
                            ";
            // line 95
            if ($this->getAttribute($context["menu_item"], "submenu", [])) {
                // line 96
                echo "                                <a class=\"submenu ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["link_class"] ?? null)), "html", null, true);
                echo "\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["menu_item"], "text", [])), "html", null, true);
                echo "</a>
                                <ul class=\"box main inactive\">
                                    ";
                // line 98
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["menu_item"], "submenu", []));
                foreach ($context['_seq'] as $context["_key"] => $context["submenu_item"]) {
                    // line 99
                    echo "                                        <li class=\"";
                    if ($this->getAttribute($context["submenu_item"], "submenu", [])) {
                        echo "seconds navigation__item submenu";
                    }
                    echo "\">
                                            <a ";
                    // line 100
                    if ( !$this->getAttribute($context["submenu_item"], "submenu", [])) {
                        echo "href=\"";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["submenu_item"], "url", [])), "html", null, true);
                        echo "\"";
                    }
                    echo " class=\"seconds submenu";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["link_class"] ?? null)), "html", null, true);
                    echo "\">";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["submenu_item"], "text", [])), "html", null, true);
                    echo "</a>
                                            ";
                    // line 101
                    if ($this->getAttribute($context["submenu_item"], "submenu", [])) {
                        // line 102
                        echo "                                                <ul class=\"seconds inactive\">
                                                    ";
                        // line 103
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["submenu_item"], "submenu", []));
                        foreach ($context['_seq'] as $context["_key"] => $context["last_submenu_item"]) {
                            // line 104
                            echo "                                                        <li class=\"last_submenu\">
                                                            <a href=\"";
                            // line 105
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["last_submenu_item"], "url", [])), "html", null, true);
                            echo "\" class=\"";
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["link_class"] ?? null)), "html", null, true);
                            echo "\">";
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["last_submenu_item"], "text", [])), "html", null, true);
                            echo "</a>
                                                        </li>
                                                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['last_submenu_item'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 108
                        echo "                                                </ul>
                                            ";
                    }
                    // line 110
                    echo "                                        </li>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['submenu_item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 112
                echo "                                </ul>
                            ";
            } else {
                // line 114
                echo "                                <a href=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["menu_item"], "url", [])), "html", null, true);
                echo "\" class=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["link_class"] ?? null)), "html", null, true);
                echo "\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["menu_item"], "text", [])), "html", null, true);
                echo "</a>
                            ";
            }
            // line 116
            echo "                        </li>                   
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu_item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 117
        echo " 
                </ul>
            </nav>
            <div class=\"bottom\">
                <div class=\"search\">
                    ";
        // line 122
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("general", "page_1"), "html", null, true);
        echo "
                </div>
                <div class=\"info\">
                    <ul>
                        <li>
                            <a class=\"support\" href=\"http://\" target=\"_blank\" rel=\"noopener noreferrer\">";
        // line 127
        echo t("Soporte", array());
        echo "</a>
                        </li>
                        <li>
                            <a href=\"http://\" target=\"_blank\" rel=\"noopener noreferrer\">";
        // line 130
        echo t("Política de privacidad", array());
        echo "</a>
                        </li>
                    </ul>
                </div>
            </div>        
        </div>
    </div>
</header>

<style>
    li.main.navigation__item ul.main.inactive {
        display:none;
    }
    li.main.navigation__item .seconds.submenu ul.seconds.inactive {
        display:none;
    }
</style>";
    }

    public function getTemplateName()
    {
        return "@basic/header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  363 => 130,  357 => 127,  349 => 122,  342 => 117,  335 => 116,  325 => 114,  321 => 112,  314 => 110,  310 => 108,  297 => 105,  294 => 104,  290 => 103,  287 => 102,  285 => 101,  273 => 100,  266 => 99,  262 => 98,  254 => 96,  252 => 95,  240 => 94,  234 => 93,  231 => 92,  225 => 89,  219 => 86,  216 => 85,  214 => 84,  211 => 83,  205 => 80,  202 => 79,  200 => 78,  193 => 73,  187 => 71,  181 => 68,  177 => 67,  172 => 66,  170 => 65,  167 => 64,  163 => 62,  157 => 60,  155 => 59,  132 => 38,  128 => 36,  122 => 34,  120 => 33,  110 => 25,  104 => 22,  101 => 21,  95 => 18,  92 => 17,  90 => 16,  78 => 11,  71 => 7,  60 => 3,  57 => 2,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@basic/header.html.twig", "/Applications/MAMP/htdocs/Global-Rheumatology/themes/custom/basic/templates/header.html.twig");
    }
}
