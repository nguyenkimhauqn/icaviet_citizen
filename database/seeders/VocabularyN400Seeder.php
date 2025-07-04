<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VocabularyTopic;
use App\Models\VocabularyCategory;
use App\Models\Vocabulary;

class VocabularyN400Seeder extends Seeder
{
    public function run(): void
    {
        $topic = VocabularyTopic::firstOrCreate([
            'name' => 'Từ vựng N-400',
        ]);

        $category = VocabularyCategory::firstOrCreate([
            'topic_id' => $topic->id,
            'name' => 'Thông tin cá nhân',
        ]);

        $vocabularies = [
            [
                'word' => 'Attending school (loa đọc)',
                'meaning' => 'đi học',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Birthday/date of birth',
                'meaning' => 'ngày sinh',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Child/children',
                'meaning' => 'con, trẻ em',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Company/workplace',
                'meaning' => 'công ty',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Currently/current',
                'meaning' => 'hiện tại',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Disability',
                'meaning' => 'khuyết tật',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Employ/employed',
                'meaning' => 'đi làm',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Full name',
                'meaning' => 'tên đầy đủ',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Hispanic',
                'meaning' => 'người gốc Tây Ban Nha',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Latino',
                'meaning' => 'người gốc Mỹ Latin',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Marital status',
                'meaning' => 'tình trạng hôn nhân',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Mental impairment',
                'meaning' => 'suy giảm trí tuệ',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Nationality',
                'meaning' => 'quốc tịch',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Social Security Number',
                'meaning' => 'số An sinh Xã hội',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Spouse',
                'meaning' => 'vợ/chồng',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Trips abroad',
                'meaning' => 'chuyến đi nước ngoài',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'U.S. citizen',
                'meaning' => 'công dân Mỹ',
                'hint' => null,
                'example' => null,
            ],
        ];

        foreach ($vocabularies as $vocab) {
            Vocabulary::create([
                'category_id' => $category->id,
                'word' => $vocab['word'],
                'meaning' => $vocab['meaning'],
                'hint' => $vocab['hint'],
                'example' => $vocab['example'],
            ]);
        }

        $category = VocabularyCategory::firstOrCreate([
            'topic_id' => $topic->id,
            'name' => 'Định nghĩa',
        ]);

        $vocabularies = [
            [
                'word' => 'claim',
                'meaning' => '',
                'hint' => 'tu say sâm-thing i-(s) tru',
                'example' => 'Thừa nhận',
            ],
            [
                'word' => 'claim to be a U.S. citizen',
                'meaning' => '',
                'hint' => '',
                'example' => 'Tự khai mình là công dân Mỹ',
            ],
            [
                'word' => 'Vote',
                'meaning' => '',
                'hint' => 'tu chu-(s) niu li-dờ-(s)',
                'example' => 'Bỏ phiếu',
            ],
            [
                'word' => 'Owe',
                'meaning' => '',
                'hint' => 'tu nót pay dét-(t)',
                'example' => 'Nợ',
            ],
            [
                'word' => 'Owe taxes',
                'meaning' => '',
                'hint' => '',
                'example' => 'Nợ thuế',
            ],
            [
                'word' => 'Overdue',
                'meaning' => '',
                'hint' => 'to pát-s-(t) ờ đét-lai',
                'example' => 'Quá hạn',
            ],
            [
                'word' => 'File a tax return',
                'meaning' => '',
                'hint' => 'tu sen-(d) tát-(s) pay-pờ-quớt-(k) tu đờ gó-vơ-mần-(t)',
                'example' => 'Khai thuế',
            ],
            [
                'word' => 'Communist Party',
                'meaning' => '',
                'hint' => 'lai-(k) chai-nờ, no-th cờ-ri-à',
                'example' => 'Đảng cộng sản',
            ],
            [
                'word' => 'Totalitarian',
                'meaning' => '',
                'hint' => 'đờ gó-vơ-mần-(t) cần-trô-(s) e-v-ri-thinh èn pi-pồ ha-(v) nâu pao-quờ',
                'example' => 'Toàn trị',
            ],
            [
                'word' => 'Overthrow',
                'meaning' => '',
                'hint' => 'tu ri-mu-(v) a gó-vơ-mần-(t) ph-rom pao-quờ',
                'example' => 'Lật đổ chính phủ',
            ],
            [
                'word' => 'Weapon',
                'meaning' => '',
                'hint' => '',
                'example' => 'Vũ khí',
            ],
            [
                'word' => 'Explosive',
                'meaning' => '',
                'hint' => 'lai-(k) bom-(b) o ti-en-ti',
                'example' => 'Like bomb or TNT',
            ],
            [
                'word' => 'Paramilitary unit',
                'meaning' => '',
                'hint' => '',
                'example' => 'Đơn vị bán quân sự',
            ],
            [
                'word' => 'Crime',
                'meaning' => '',
                'hint' => 'đì ác-sần đát-(t) b-rây-(k) đờ lo',
                'example' => 'Tội phạm',
            ],
            [
                'word' => 'Commit a crime',
                'meaning' => '',
                'hint' => '',
                'example' => 'Phạm tội',
            ],
            [
                'word' => 'Arrested',
                'meaning' => '',
                'hint' => '',
                'example' => 'Bị bắt',
            ],
            [
                'word' => 'Offense',
                'meaning' => '',
                'hint' => null,
                'example' => 'Phàm tội nhẹ',
            ],
            [
                'word' => 'Cited',
                'meaning' => '',
                'hint' => '',
                'example' => 'Bị vé phạt',
            ],
            [
                'word' => 'Confined',
                'meaning' => '',
                'hint' => '',
                'example' => 'Bị giam giữ/bị giới hạn trong một khu vực',
            ],
            [
                'word' => 'Prostitute',
                'meaning' => '',
                'hint' => '',
                'example' => 'Người bán dâm',
            ],
            [
                'word' => 'Procure',
                'meaning' => '',
                'hint' => '',
                'example' => 'Môi giới',
            ],
            [
                'word' => 'Illegal drug, narcotics',
                'meaning' => '',
                'hint' => '',
                'example' => 'Chất cấm, ma túy',
            ],
            [
                'word' => 'Drug paraphernalia',
                'meaning' => '',
                'hint' => '',
                'example' => 'Đồ dùng ma túy',
            ],
            [
                'word' => 'Gamble',
                'meaning' => '',
                'hint' => '',
                'example' => 'Đánh bạc',
            ],
            [
                'word' => 'Pay alimony',
                'meaning' => '',
                'hint' => '',
                'example' => 'Trả tiền cấp dưỡng',
            ],
            [
                'word' => 'Public benefit',
                'meaning' => '',
                'hint' => '',
                'example' => 'Phúc lợi công cộng',
            ],
            [
                'word' => 'False',
                'meaning' => '',
                'hint' => '',
                'example' => 'Sai',
            ],
            [
                'word' => 'Fraudulent',
                'meaning' => '',
                'hint' => '',
                'example' => 'Nói dối',
            ],
            [
                'word' => 'Deportation proceedings',
                'meaning' => '',
                'hint' => '',
                'example' => 'Thủ tục trục xuất',
            ],
            [
                'word' => 'Drafted',
                'meaning' => '',
                'hint' => '',
                'example' => 'Gọi nhập ngũ',
            ],
            [
                'word' => 'Oath of Allegiance',
                'meaning' => '',
                'hint' => '',
                'example' => 'Lời Tuyên thệ Trung thành',
            ],
            [
                'word' => 'Armed group',
                'meaning' => '',
                'hint' => 'ờ g-rúp ợp pi-pồ quít-(th) que-pần-(s)',
                'example' => 'Nhóm vũ trang',
            ],
            [
                'word' => 'Arrested',
                'meaning' => '',
                'hint' => 'kép-(t) in cớt-s-tơ-đi bai đờ po-li-(s)',
                'example' => 'Bị bắt',
            ],
            [
                'word' => 'Assassination',
                'meaning' => '',
                'hint' => 'Tu kiu sâm-quan im-pó-tần-(t), lai-(k) a p-ré-gi-đềnh-(t) o ờ li-đờ',
                'example' => 'Ám sát',
            ],
            [
                'word' => 'Assault',
                'meaning' => '',
                'hint' => 'tu hớt-(t) sâm-quan',
                'example' => 'Hành hung',
            ],
            [
                'word' => 'Bear arm',
                'meaning' => '',
                'hint' => 'tu on o diu-(s) ờ gân',
                'example' => 'Cầm vũ khí',
            ],
            [
                'word' => 'Cited',
                'meaning' => '',
                'hint' => 'gi-vân ờ tít-kịt bai po-li-(s)',
                'example' => 'Bị vé phạt',
            ],
            [
                'word' => 'claim',
                'meaning' => '',
                'hint' => 'tu say sâm-thing i-(s) tru',
                'example' => 'Thừa nhận',
            ],
            [
                'word' => 'claim to be a U.S. citizen',
                'meaning' => '',
                'hint' => 'tu s-tay-(t) diu a ờ diu-ét-(s) si-ti-giần',
                'example' => 'Tự khai mình là công dân Mỹ',
            ],
            [
                'word' => 'Combat',
                'meaning' => '',
                'hint' => null,
                'example' => 'Chiến đấu',
            ],
            [
                'word' => 'Communist Party',
                'meaning' => '',
                'hint' => 'lai-(k) chai-nờ, no-th cờ-ri-à',
                'example' => 'Đảng cộng sản',
            ],
            [
                'word' => 'Confined',
                'meaning' => '',
                'hint' => 'lót-k-(t) in ờ p-lay-(s)',
                'example' => 'Bị giam giữ/bị giới hạn trong một khu vực',
            ],
            [
                'word' => 'Crime',
                'meaning' => '',
                'hint' => 'đì ác-sần đát-(t) b-rây-(k) đờ lo',
                'example' => 'Tội phạm',
            ],
            [
                'word' => 'Commit a crime',
                'meaning' => '',
                'hint' => 'tu đu sâm-thinh đát b-ray-k-(s) đờ lo',
                'example' => 'Phạm tội',
            ],
            [
                'word' => 'Deportation proceedings',
                'meaning' => '',
                'hint' => 'p-ró-sẹt-(s) ọp sen-đinh sâm-quan ao-(t) of đờ diu-ét-(s)',
                'example' => 'Thủ tục trục xuất',
            ],
            [
                'word' => 'Detained',
                'meaning' => '',
                'hint' => null,
                'example' => 'Bị giam giữ',
            ],
            [
                'word' => 'Drafted',
                'meaning' => '',
                'hint' => 'bi-inh si-lét-tịt át-(s) ờ sâu-chờ',
                'example' => 'Gọi nhập ngũ',
            ],
            [
                'word' => 'Drug paraphernalia',
                'meaning' => '',
                'hint' => 'thinh-(s) diu-s-(d) pho ì-li-gồ d-rớt-(s)',
                'example' => 'Đồ dùng ma túy',
            ],
            [
                'word' => 'Explosive',
                'meaning' => '',
                'hint' => 'lai-(k) bom-(b) o ti-en-ti',
                'example' => 'Chất nổ',
            ],
            [
                'word' => 'False',
                'meaning' => '',
                'hint' => 'nót tru',
                'example' => 'Sai',
            ],
            [
                'word' => 'File a tax return',
                'meaning' => '',
                'hint' => 'tu sen-(d) tát-(s) pay-pờ-quớt-(k) tu đờ gó-vơ-mần-(t)',
                'example' => 'Khai thuế',
            ],
            [
                'word' => 'Fraudulent',
                'meaning' => '',
                'hint' => 'tu lai',
                'example' => 'Gian lận',
            ],
            [
                'word' => 'Gamble',
                'meaning' => '',
                'hint' => 'tu p-lay gem-(s) pho mân-ni',
                'example' => 'Đánh bạc',
            ],
            [
                'word' => 'Genocide',
                'meaning' => '',
                'hint' => null,
                'example' => 'Diệt chủng',
            ],
            [
                'word' => 'Hereditary title',
                'meaning' => '',
                'hint' => null,
                'example' => 'Tước vị thừa kế',
            ],
            [
                'word' => 'Hijacking',
                'meaning' => '',
                'hint' => null,
                'example' => 'Cướp phương tiện',
            ],
            [
                'word' => 'Illegal drug, narcotics',
                'meaning' => '',
                'hint' => 'lai-(k) he-râu-in',
                'example' => 'Chất cấm, ma túy',
            ],
            [
                'word' => 'Immigration benefit',
                'meaning' => '',
                'hint' => 'lai-(k) ờ vi-sờ, g-rin ca-(d), o si-ti-giần-síp',
                'example' => 'Quyền lợi di trú',
            ],
            [
                'word' => 'Kidnapping',
                'meaning' => '',
                'hint' => 'tu tay-(k) sâm-quan ờ-quay bai phót-(s)',
                'example' => 'Bắt cóc',
            ],
            [
                'word' => 'Military-type training',
                'meaning' => '',
                'hint' => 'tu tren lai-(k) sâu-chờ-(s)',
                'example' => 'Huấn luyện kiểu quân sự',
            ],
            [
                'word' => 'Military unit',
                'meaning' => '',
                'hint' => 'ờ g-rúp ọp sâu-chờ-(s)',
                'example' => 'Đơn vị quân đội',
            ],
            [
                'word' => 'Noncombatant service',
                'meaning' => '',
                'hint' => 'sờ-pót-(t) đì a-r-mi, bớt nâu phai-đinh',
                'example' => 'Nhiệm vụ không chiến đấu',
            ],
            [
                'word' => 'Offense',
                'meaning' => '',
                'hint' => 'ờ mai-nờ c-ram',
                'example' => 'Phạm tội nhẹ',
            ],
            [
                'word' => 'Oath of Allegiance',
                'meaning' => '',
                'hint' => 'ờ p-ró-mịt-(s) tu bi loi-ồ tu đờ diu-nai-tịt s-tây-(s)',
                'example' => 'Lời Tuyên thệ Trung thành',
            ],
            [
                'word' => 'Overdue',
                'meaning' => '',
                'hint' => 'tu pát-s-(t) ờ đét-lai',
                'example' => 'Quá hạn',
            ],
            [
                'word' => 'Overthrow',
                'meaning' => '',
                'hint' => 'tu ri-mu-(v) a gó-vơ-mần-(t) ph-rom pao-quờ',
                'example' => 'Lật đổ chính phủ',
            ],
            [
                'word' => 'Owe',
                'meaning' => '',
                'hint' => 'tu nót pay dét-(t)',
                'example' => 'Nợ',
            ],
            [
                'word' => 'Owe taxes',
                'meaning' => '',
                'hint' => 'tu nót pay mân-ni tu đờ gỏ-vơ-mần-(t) dét-(t)',
                'example' => 'Nợ thuế',
            ],
            [
                'word' => 'Paramilitary unit',
                'meaning' => '',
                'hint' => 'nót óp-phi-sồ a-r-mi',
                'example' => 'Đơn vị bán quân sự',
            ],
            [
                'word' => 'Pay alimony',
                'meaning' => '',
                'hint' => 'tu gi-(v) mân-ni tu ịt-s-pao-(s)',
                'example' => 'Trả tiền cấp dưỡng',
            ],
            [
                'word' => 'Prison or jail',
                'meaning' => '',
                'hint' => 'ờ p-lay-(s) que p-ri-sân-nờ-(s) a kép-(t)',
                'example' => 'Trại giam, nhà tù',
            ],
            [
                'word' => 'Procure',
                'meaning' => '',
                'hint' => 'tu phai-(d) ờ p-ró-s-ti-tiu-(t) pho sâm-quan',
                'example' => 'Môi giới',
            ],
            [
                'word' => 'Prostitute',
                'meaning' => '',
                'hint' => 'ờ pơ-sần hu ha-(s) sét-(s) pho mân-ni',
                'example' => 'Người bán dâm',
            ],
            [
                'word' => 'Public benefit',
                'meaning' => '',
                'hint' => 'go-vơ-mân-(t) hép-(s) lai-(k) mân-ni èn phu-(d) s-tem-p-(s)',
                'example' => 'Phúc lợi công cộng',
            ],
            [
                'word' => 'Sabotage',
                'meaning' => '',
                'hint' => 'tu đì-s-troi sâm-thinh on pơ-pợt-(s)',
                'example' => 'Cố ý phá hoại',
            ],
            [
                'word' => 'Torture',
                'meaning' => '',
                'hint' => 'tu hớt-(t) sâm-quan',
                'example' => 'Tra tấn',
            ],
            [
                'word' => 'Totalitarian',
                'meaning' => '',
                'hint' => 'đờ gó-vơ-mần-(t) cần-trô-(s) e-v-ri-thinh èn pi-pồ ha-(v) nâu pao-quờ',
                'example' => 'Toàn trị',
            ],
            [
                'word' => 'Vote',
                'meaning' => '',
                'hint' => 'tu chu-(s) niu li-dờ-(s)',
                'example' => 'Bỏ phiếu',
            ],
            [
                'word' => 'Weapon',
                'meaning' => '',
                'hint' => 'lai-(k) ờ k-nai-(ph) o gân',
                'example' => 'Vũ khí',
            ],
            [
                'word' => 'Weapon training',
                'meaning' => '',
                'hint' => 'tu lơn hao tu diu gân-(s)',
                'example' => 'Huấn luyện sử dụng vũ khí',
            ],
        ];

        foreach ($vocabularies as $vocab) {
            Vocabulary::create([
                'category_id' => $category->id,
                'word' => $vocab['word'],
                'meaning' => $vocab['meaning'],
                'hint' => $vocab['hint'],
                'example' => $vocab['example'],
            ]);
        }
    }
}
