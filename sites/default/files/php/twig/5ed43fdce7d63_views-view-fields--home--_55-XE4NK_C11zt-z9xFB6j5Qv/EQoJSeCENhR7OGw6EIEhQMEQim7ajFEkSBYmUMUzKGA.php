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

/* themes/custom/basic/templates/views/home/views-view-fields--home--block-6.html.twig */
class __TwigTemplate_8073e7933fddac2b1cc1592532ca3b5b826f392ca08ad164db3ce0bf7badbeed extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = ["escape" => 3];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape'],
                []
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
        echo "<div class=\"item-news more-shared home\">
    <div class=\"picture\">
        <figure>";
        // line 3
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "field_image", []), "content", [])), "html", null, true);
        echo "</figure>
    </div>
    <div class=\"text\">
        <h3 class=\"title\">";
        // line 6
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "title", []), "content", [])), "html", null, true);
        echo "</h3>
        <p class=\"sumary\">";
        // line 7
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "body", []), "content", [])), "html", null, true);
        echo "</p>
        <div class=\"info-more\">
            <div class=\"info\">
                <span><b>";
        // line 10
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "field_nombre", []), "content", [])), "html", null, true);
        echo "</b>,";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "created", []), "content", [])), "html", null, true);
        echo "</span>
            </div>
            <div class=\"explorer\">";
        // line 12
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "nothing_1", []), "content", [])), "html", null, true);
        echo "</div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "themes/custom/basic/templates/views/home/views-view-fields--home--block-6.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 12,  75 => 10,  69 => 7,  65 => 6,  59 => 3,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/basic/templates/views/home/views-view-fields--home--block-6.html.twig", "/Volumes/HD-Project-Macbook/Web/Desarrollos Web/proyectos/global-rheumatology/themes/custom/basic/templates/views/home/views-view-fields--home--block-6.html.twig");
    }
}
