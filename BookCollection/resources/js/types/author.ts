// TODO: je kunt evt. nog een base model maken waar de id, created_at en updated_at velden in
// staan en de individuele interfaces hier op laten extenden

export interface Author {
    id: number;
    name: string;
    created_at: string;
    updated_at: string;
}
