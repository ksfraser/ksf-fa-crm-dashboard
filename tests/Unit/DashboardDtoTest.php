<?php
declare(strict_types=1);
namespace Ksfraser\FrontAccounting\CRM\Dashboard\Tests\Unit;
use PHPUnit\Framework\TestCase;
use Ksfraser\FrontAccounting\CRM\Dashboard\DTO\DashboardDTO;
class DashboardDtoTest extends TestCase
{
    public function testDtoRoundTripsThroughArray(): void {
        $dto = new DashboardDTO(5, 'Pipeline Value', 'kpi', '{"pipeline":"open"}', '1', '1');
        $arr = $dto->toArray();
        $this->assertSame(5, $arr['widget_id']);
        $this->assertSame('Pipeline Value', $arr['name']);
        $this->assertSame('kpi', $arr['type']);
        $this->assertSame('1', $arr['position']);
        $this->assertSame('1', $arr['is_active']);
        $dto2 = DashboardDTO::fromArray($arr);
        $this->assertSame($dto->widget_id, $dto2->widget_id);
        $this->assertSame($dto->name, $dto2->name);
        $this->assertSame($dto->is_active, $dto2->is_active);
    }
    public function testDisplayLabelUsesNameAndTypeWhenSet(): void {
        $dto = new DashboardDTO(1, 'Pipeline Value', 'kpi');
        $this->assertStringContainsString('Pipeline Value', $dto->getDisplayLabel());
        $this->assertStringContainsString('kpi', $dto->getDisplayLabel());
    }
    public function testDisplayLabelFallsBackToId(): void {
        $dto = new DashboardDTO(9, '', '', '', '0', '0');
        $this->assertStringContainsString('Dashboard Widget #9', $dto->getDisplayLabel());
    }
}
