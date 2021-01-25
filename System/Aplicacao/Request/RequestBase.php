<?php

namespace System\Aplicacao\Request;

use InvalidArgumentException;

abstract class RequestBase
{
    /** @var Request */
    protected $request;
    /** @var bool */
    private $finalizado = false;

    public function __construct()
    {
        $this->request = new Request();
        $this->request->setDefaults();
    }

    /**
     * Dados do $_GET e $_POST
     * @return array
     */
    public function all(): array
    {
        if ($this->finalizado === false) {
            $this->finaliza();
        }
        return $this->request->all();
    }

    public function post(): array
    {
        if ($this->finalizado === false) {
            $this->finaliza();
        }
        return $this->request->post();
    }

    public function get(): array
    {
        if ($this->finalizado === false) {
            $this->finaliza();
        }
        return $this->request->get();
    }

    public function session(): array
    {
        if ($this->finalizado === false) {
            $this->finaliza();
        }
        return $this->request->session();
    }

    protected function setRequest(Request $request = null): void
    {
        if ($request) {
            $this->request = $request;
        }
    }

    public function __destruct()
    {
        $this->finaliza();
    }

    private function filtraDadosRequest(): void
    {
        $post = $this->filtraDados($this->request->post());
        $get = $this->filtraDados($this->request->get());
        $this->request = new Request($get, $post, $this->request->session());
    }

    private function filtraDados(array $dataRequest): array
    {
        $campos = $this->campos();
        $response = [];
        foreach ($dataRequest as $name => $value) {
            if (in_array($name, $campos, true)) {
                $response[$name] = $value;
            }
        }
        return $response;
    }

    private function checkCampoExiste(string $value, array $data): bool
    {
        if (empty($data)) {
            return true;
        }
        return isset($data[$value]) === false;
    }

    /**
     * @return bool
     */
    abstract public function acessoAutorizado(): bool;

    /**
     * @return array
     */
    abstract public function campos(): array;

    private function finaliza(): void
    {
        if ($this->finalizado || empty($this->campos())) {
            return;
        }
        $this->finalizado = true;
        $this->filtraDadosRequest();
        $valoresAtuais = $this->request->all();

        $valoresNaoEncontrados = array_filter($this->campos(), function (string $campo) use ($valoresAtuais) {
            return $this->checkCampoExiste($campo, $valoresAtuais);
        });

        if (empty($valoresNaoEncontrados) === false) {
            $valores = implode(",", $valoresNaoEncontrados);
            throw new InvalidArgumentException("Alguns valores são obrigatórios na requisição: {$valores}");
        }
    }
}
