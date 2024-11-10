<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* inicioTwig.twig */
class __TwigTemplate_512d97f52ddd26392c7bd548e7648678 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>ForoCrianza</title>
</head>
<body>
    <h1>";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["titulo"] ?? null), "html", null, true);
        yield "</h1>
    <h2>Tu foro de crianzaaadsa</h2>
    <p>Bienvenido ";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nombre"] ?? null), "html", null, true);
        yield "</p>
</body>
</html>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "inicioTwig.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  57 => 11,  52 => 9,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "inicioTwig.twig", "/home/user/proxecto/app/Views/inicioTwig.twig");
    }
}
