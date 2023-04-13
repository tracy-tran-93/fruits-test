export class CNutrition {
  calories = 0;
  fat = 0;
  sugar = 0;
  carbohydrates = 0;
  protein = 0;
  constructor (init?: Partial<CNutrition>) {
    Object.assign(this, init)
  }
}

export class CFruit {
  id!: number;
  name = '';
  image = '';
  family = '';
  order = '';
  genus = '';
  nutritions = new CNutrition();
  constructor (init?: Partial<CFruit>) {
    Object.assign(this, init)
  }
}

export interface UrlParams {
  page?: number;
  limit?: number;
  query?: string;
}
